<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends AppController
{
    public function veryfy(){
         
        \Mail::send('emails.visitor_email', ['name' => "Vahan", 'email' => "vahan.musayelyan@mail.ru", 'title' => "hastatum", 'content' => "connection"], function ($message) {
            $message->to('vahan.musayelyan@mail.ru')->subject('Subject of the message!');
        });
    }
}
