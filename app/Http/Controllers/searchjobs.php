<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\addproducts;
use App\Models\jobs;
use App\Models\watchlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use routes\web;
use App\Models\jobs_applied;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



class searchjobs extends Controller
{

    function searchjob()
    {
        return redirect('dashboard');
    }
    function addproduct(Request $request)
    {

        $products = new addproducts;
        $products->product_name =  request('name');
        $products->product_price =  request('price');
        $products->quantity =  request('quantity');

        $products->save();
    }
    public function addjobs(Request $request)
    {


        $jobs = new jobs;
        $jobs->job_role = $request->input('jobrole');
        $jobs->location = $request->input('location');
        $jobs->experience = $request->input('experience');
        $jobs->qualification = $request->input('qualification');
        $jobs->salary = $request->input('salary');


        // isajax((()))
        // $file = $request->file('job_image');
        // // if ($request->hasFile('job_image')) {
        // //     $fileName = time() . '_' . $file->getClientOriginalName();
        // //     $file->storeAs('job_image', $fileName, 'public');
        // //     Storage::disk('public')->exists('image/' . $fileName);
        // // }
        $file = $request->file('job_image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('image'), $fileName);
        $jobs->job_image = $fileName;
        $jobs->save();

        return response()->json([$jobs]);
    }
    function addtowatchlist(Request $req)
    {

        $jobs = jobs::all();
        $watchlist = new watchlist;
        $watchlist->user_id = Auth::user()->id;
        $watchlist->job_id = $req->jobid;
        $result = watchlist::where('job_id', $watchlist->job_id)->where('user_id', $watchlist->user_id)->count();
        if ($result > 0) {
            return  redirect('/dashboard')->with("error", "Already added to the watchlist");
        } else {

            $watchlist->save();
            return view('/dashboard', ['jobs' => $jobs])->with('watchlistsuccess', "Successfully added to the watchlist");
        }
    }
    static function watchlist()
    {

        $user_id = Auth::user()->id;
        return watchlist::where('user_id', $user_id)->count();
    }
    function viewwatchlist()
    {

        $user_id = Auth::user()->id;

        $viewwatchlist = DB::table('watchlist')
            ->join('jobs', 'watchlist.job_id', '=', 'jobs.id')
            ->where('watchlist.user_id', $user_id)
            ->select('jobs.*')
            ->get();
        //    return response()->json($viewwatchlist);
        return view('layouts/watchlist', ['viewwatchlist' => $viewwatchlist]);
    }
    function jobs_applied(Request $request)
    {
        $jobs_applied = new jobs_applied;
        $jobs_applied->user_id = Auth::user()->id;
        $jobs_applied->job_id = $request->job_id;
        $result = jobs_applied::where('job_id', $jobs_applied->job_id)->where('user_id', $jobs_applied->user_id)->count();
        if ($result > 0) {
            return  redirect('/dashboard')->with("error", "You Already Applied for this Job");
        } else {

            $jobs_applied->save();
            $user_id = Auth::user()->id;
            $Rmail = Auth::user()->email;
            $job_id = request('job_id');
            $jobs = jobs::where('id', $job_id)->get();


            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'bountybazzaar@gmail.com';                     //SMTP username
                $mail->Password   = 'lubijdycsmpqxbdw';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                //Recipients
                $mail->setFrom('bountybazzaar@gmail.com', 'JobX');
                $mail->addAddress($Rmail);     //Add a recipient
                ;


                // Extracting values from the first job object
                $job = isset($jobs[0]) ? $jobs[0] : null;
                if ($job) {
                    $job_role = $job['job_role'] ?? 'Unknown Job Role';
                    $location = $job['location'] ?? 'Unknown Location';
                    $experience = $job['experience'] ?? 'Unknown Experience';
                    $qualification = $job['qualification'] ?? 'Unknown Qualification';
                    $salary = $job['salary'] ?? 'Unknown Salary';

                    // Constructing the email body with multiple values with HTML line breaks
                    $mail_body = "<h1>Job Applied Successfully! </h1><br>";
                    $mail_body .= "Job Role:<b> $job_role </b><br>";
                    $mail_body .= "Location:<b> $location </b><br>";
                    $mail_body .= "Experience:<b> $experience</b><br>";
                    $mail_body .= "Qualification:<b> $qualification</b><br>";
                    $mail_body .= "Salary:<b> $salary</b><br>";
                } else {
                    $mail_body = 'No job found';
                }
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'JobX';
                $mail->Body    = $mail_body;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return redirect('/dashboard')->with("success", "Applied successfully");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        // return response()->json($jobs_applied);

    }
    function view_jobs_applied()
    {

        $user_id = Auth::user()->id;
        $view_jobs_applied = DB::table('jobs_applied')
            ->join('jobs', 'jobs_applied.job_id', '=', 'jobs.id')
            ->where('jobs_applied.user_id', $user_id)
            ->select('jobs.*')
            ->get();

        return view('layouts/view_jobs_applied', ['viewjobsapplied' => $view_jobs_applied]);

        // return redirect('/viewjobsapplied');
        // // return response()->json($viewwatchlist); 

    }
    function remove_watchlist_jobs(Request $req)
    {

        $j_id = request('job_id');


        $watchlistuser_id = Auth::user()->id;
        $remove_watchlist = watchlist::where('user_id', $watchlistuser_id)->where('job_id', $j_id);
        $remove_watchlist->delete();

        return redirect('/watchlist');
    }
    function Authaddjobs()
    {
        return view('layouts/jobs');
    }

    function view_status()
    {

        return view('layouts/view_status');
    }
}
