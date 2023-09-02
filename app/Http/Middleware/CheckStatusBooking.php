<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{Book , Room};
use Carbon\Carbon;

class CheckStatusBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $books = Book::where('check_out_date' ,'>=', Carbon::now()->format('Y-m-d') )->get();

        foreach($books as $book){
            $room = Room::find($book->room->id);
            $room->status="available";
            $room->save();
        }
        return $next($request);
    }
}
