<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\SharableLink;
use App\Models\Click;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    // 1. Show the main dashboard area with active marketing campaigns
    public function index()
    {
        $contents = Content::latest()->get();
        
        // Fetch leaderboard ranking top users
        $leaderboard = User::orderBy('points', 'desc')->take(10)->get();

        return view('dashboard', compact('contents', 'leaderboard'));
    }

    // 2. Generate a unique tracking link for an employee
    public function generateLink(Request $request, Content $content)
    {
        $user = Auth::user();

        // Check if employee already generated a link for this specific content
        $existingLink = SharableLink::where('user_id', $user->id)
                                    ->where('content_id', $content->id)
                                    ->first();

        if ($existingLink) {
            return back()->with('status', 'You already have a link for this content!');
        }

        // Create a unique short code
        SharableLink::create([
            'user_id' => $user->id,
            'content_id' => $content->id,
            'unique_code' => Str::random(6),
        ]);

        return back()->with('status', 'Tracking link generated successfully!');
    }

    
        // 3. The Tracker Engine: Intercept clicks, grant points, and forward to the source article
    public function trackClick($code)
    {
        $link = SharableLink::where('unique_code', $code)->firstOrFail();
        $ipAddress = request()->ip();

        // 🔥 FRAUD CHECK: Has this IP address already clicked this specific link?
        $alreadyClicked = Click::where('sharable_link_id', $link->id)
                               ->where('ip_address', $ipAddress)
                               ->exists();

        // 1. Simulate an ABM reverse-IP lookup or target tracking array
        $targetDomains = ['google.com', 'microsoft.com', 'apple.com', 'chevron.com'];
        
        // Let's randomly tag 40% of clicks as a premium target account match for testing!
        $isTargetAccount = (rand(1, 10) <= 4); 
        $detectedDomain = $isTargetAccount ? $targetDomains[array_rand($targetDomains)] : null;

        // 2. Log the click inside our database with the ABM domain details
        Click::create([
            'sharable_link_id' => $link->id,
            'ip_address' => $ipAddress,
            'target_domain' => $detectedDomain, 
        ]);

        // 3. Only reward the employee if this is a BRAND NEW unique IP address click!
        if (!$alreadyClicked) {
            $pointsEarned = $link->content->points_per_click;

            // ABM BONUS: If it matches a target account, give 100 extra bonus points!
            if ($detectedDomain) {
                $pointsEarned += 100;
            }

            $employee = $link->user;
            $employee->increment('points', $pointsEarned);

            // 🔥 AUTOMATION TRIGGER: Evaluate KPIs and distribute rewards instantly!
            $this->checkAndDistributeRewards($employee);
        }

        // 4. Redirect out to the target article (Always redirects, even if fraud)
        return redirect()->away($link->content->original_url);
    }

    /**
     * Automated Incentive Evaluation Engine
     */
    protected function checkAndDistributeRewards($employee)
    {
        // Define automated milestone incentive tiers linked to employee KPIs
        $milestones = [
            100  => ['type' => '🌟 $10 Starbucks Gift Card', 'threshold' => 100],
            500  => ['type' => '🚀 $50 Amazon Gift Card', 'threshold' => 500],
            1000 => ['type' => '🏆 $100 Performance Cash Bonus + Executive Recognition', 'threshold' => 1000],
        ];

        foreach ($milestones as $points => $meta) {
            if ($employee->points >= $points) {
                // Verify if this milestone reward has already been issued to protect company budgets
                $alreadyRewarded = \DB::table('reward_milestones')
                    ->where('user_id', $employee->id)
                    ->where('points_threshold', $points)
                    ->exists();

                if (!$alreadyRewarded) {
                    // 1. Log the reward issuance event permanently into the database log
                    \DB::table('reward_milestones')->insert([
                        'user_id' => $employee->id,
                        'points_threshold' => $points,
                        'reward_type' => $meta['type'],
                        'is_distributed' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // 2. Broadcast the automated achievement announcement to the workplace channel
                    $this->sendAutomatedCompanyAlert($employee, $meta['type']);
                }
            }
        }
    }

    /**
     * Dispatch External Outbound Communication Webhook Payload
     */
    protected function sendAutomatedCompanyAlert($employee, $rewardType)
    {
        $slackWebhookUrl = env('SLACK_WEBHOOK_URL');

        // Fires a secure network request containing formatted Slack markdown message layout blocks
        if ($slackWebhookUrl) {
            \Illuminate\Support\Facades\Http::post($slackWebhookUrl, [
                'text' => "🔥 *AMPLIFI REWARD AUTOMATION ENGINE* \n👉 *{$employee->name}* just hit an enterprise milestone and was automatically issued: *{$rewardType}*! \nKeep deploying those ABM plays! 🚀"
            ]);
        }
    }


}
