<?php


namespace App\Repositories;
use App\Interfaces\CommentRepo;
use App\Models\Company;

class CommentRepoImp implements CommentRepo
{
    public function show()
    {
        $list = [];
        $companies = Company::with('comments')->get();
        foreach ($companies as $company) {
            $list[$company->name] = [];
            foreach ($company->comments as $comment) {
                array_push($list[$company->name], $comment->comment);
            }

        }

        return $list;
    }
}
