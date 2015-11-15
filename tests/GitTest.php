<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Git;

class GitTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testInitialize()
    {
        $git = new Git();
        // getBranchList Exception Test
        try {
            $git->getBranchList(false);
            $this->assertTrue(false);
        }catch(Exception $e) {
            $this->assertTrue(true);
        }
        // getBranchList Exception Test2 (argument true)
        try {
            $git->getBranchList(true);
            $this->assertTrue(false);
        }catch(Exception $e) {
            $this->assertTrue(true);
        }
        // getBranchName Exception Test
        try {
            $git->getBranchName();
            $this->assertTrue(false);
        } catch(Exception $e) {
            $this->assertTrue(true);
        }
        //$git->initialize('/home/watanabe/AMS_GIT/');
        // getBranchList Exception Test
        try {
            $git->getBranchList(false);
            $this->assertTrue(true);
        }catch(Exception $e) {
            $this->assertTrue(false);
        }
        // getBranchList Exception Test2 (argument true)
        try {
            $git->getBranchList(true);
            $this->assertTrue(true);
        }catch(Exception $e) {
            $this->assertTrue(false);
        }
        // getBranchName Exception Test
        try {
            $git->getBranchName();
            $this->assertTrue(true);
        } catch(Exception $e) {
            $this->assertTrue(false);
        }
    }
}
