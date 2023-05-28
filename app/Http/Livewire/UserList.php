<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $users = [];

   public $page = 1;

   public $per_page = 6;

    protected $listeners = ['loadMoreData'];

    protected $queryString = [
        'page',
        'per_page'
    ];

    public function render()
    {
        return view('livewire.user-list');
    }

    public function loadData(): void
    {
        $paginatedUsers = User::orderByDesc('registration_timestamp')
            ->paginate($this->per_page, ['*'], 'page', $this->page)
            ->items();

        foreach ($paginatedUsers as $user) {
            $this->users[] = $user->toArray();
        }
    }

    public function loadMoreData(): void
    {
        $page = ++$this->page;

        $paginatedUsers = User::orderByDesc('registration_timestamp')
            ->paginate(6, ['*'], 'page', $page)
            ->items();

        foreach ($paginatedUsers as $user) {
            $this->users[] = $user->toArray();
        }
    }
}
