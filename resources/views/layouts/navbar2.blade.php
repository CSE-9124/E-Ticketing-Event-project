<div class="topbar w-full h-[60px] flex justify-between items-center px-6">
    {{-- Toggle Dark Mode --}}
    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
    </button>

    <!-- Search Bar -->
    <div class="relative w-[400px] mx-[10px] ">
        <label class="relative w-full">
            <input type="text" placeholder="Search here"
                class="w-full h-[40px] rounded-full pl-[35px] pr-[20px] py-[5px] text-[18px] border outline-none border-gray-700 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <ion-icon name="search-outline" class="absolute top-0 left-[10px] text-[1.2rem] dark:text-gray-400"></ion-icon>
        </label>
    </div>

    <!-- Profile Picture -->
    <div>
        <button type="button"
            class="relative flex text-sm bg-gray-800 rounded-full overflow-hidden focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            aria-expanded="false" data-dropdown-toggle="dropdown-user">
            <span class="sr-only">Open user menu</span>
            <img class="w-[40px] h-[40px] rounded-full object-cover"
                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
        </button>
    </div>
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-user">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ auth()->user()->name }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ auth()->user()->email }}
            </p>
        </div>
        <ul class="py-1" role="none">
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white transition-all duration-300 ease-in-out"
                    role="menuitem">
                    <ion-icon name="person-outline" class="text-base"></ion-icon>
                    Profile
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 font-semibold hover:bg-red-600 hover:text-white transition-all duration-300 ease-in-out">
                        <ion-icon name="log-out-outline" class="text-base"></ion-icon>
                        Log out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
