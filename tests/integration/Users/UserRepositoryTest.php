<?php

use Larabook\Users\UserRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class UserRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = new UserRepository;
    }

    /** @test */
    public function it_paginates_all_users()
    {
        TestDummy::times(4)->create('Larabook\Users\User');

        $results = $this->repo->getPaginated(2);

        $this->assertCount(2, $results);
    }

    /** @test */
    public function it_finds_a_user_with_statuses_by_their_username()
    {
        $statuses = TestDummy::times(3)->create('Larabook\Statuses\Status');
        $username = $statuses[0]->user->username;

        $user = $this->repo->findByUsername($username);

        $this->assertEquals($username, $user->username);
        $this->assertCount(3, $user->statuses);
    }

    /** @test */
    public function it_follows_another_user()
    {
        $users = TestDummy::times(2)->create('Larabook\Users\User');
        $this->repo->follow($users[1]->id, $users[0]);

        $this->assertCount(1, $users[0]->followedUsers);
        $this->assertTrue($users[0]->followedUsers->contains($users[1]->id));

        $this->tester->seeRecord('follows', [
            'follower_id' => $users[0]->id,
            'followed_id' => $users[1]->id
        ]);
    }

    /** @test */
    public function it_unfollows_another_user()
    {
        $users = TestDummy::times(2)->create('Larabook\Users\User');
        $this->repo->follow($users[1]->id, $users[0]);

        $this->repo->unfollow($users[1]->id, $users[0]);

        $this->tester->dontSeeRecord('follows', [
            'follower_id' => $users[0]->id,
            'followed_id' => $users[1]->id
        ]);
    }
}