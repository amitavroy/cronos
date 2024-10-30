<script setup>
import {Link} from "@inertiajs/vue3";

const nav = {
  "primary": [
    {name: "Home", url: "/"},
    {name: "Secondary", url: "/",
      subItems: [{name: "Item A", url: "/"}, {name: "Item2", url: "/"},]
    }
  ],
  "secondary": []
}
</script>

<template>
  <div class="navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h8m-8 6h16"/>
          </svg>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li v-for="(item, index) in nav.primary" :key="index">
            <!-- Main Link for items without subItems -->
            <Link v-if="!item.subItems" :href="item.url">{{ item.name }}</Link>

            <!-- Dropdown Menu for items with subItems -->
            <details v-else>
              <summary>{{ item.name }}</summary>
              <ul class="p-2">
                <li v-for="(subItem, subIndex) in item.subItems" :key="subIndex">
                  <Link :href="subItem.url">{{ subItem.name }}</Link>
                </li>
              </ul>
            </details>
          </li>
        </ul>
      </div>

      <a class="btn btn-ghost text-xl">daisyUI</a>
    </div>

    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        <li v-for="(item, index) in nav.primary" :key="index">
          <!-- Main Link for items without subItems -->
          <Link v-if="!item.subItems" :href="item.url">{{ item.name }}</Link>

          <!-- Dropdown Menu for items with subItems -->
          <details v-else>
            <summary>{{ item.name }}</summary>
            <ul class="p-2">
              <li v-for="(subItem, subIndex) in item.subItems" :key="subIndex">
                <Link :href="subItem.url">{{ subItem.name }}</Link>
              </li>
            </ul>
          </details>
        </li>
      </ul>
    </div>

    <div class="navbar-end">
      <button class="btn btn-ghost btn-circle">
        <div class="indicator">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
          <span class="badge badge-xs badge-primary indicator-item"></span>
        </div>
      </button>

      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img
              alt="Tailwind CSS Navbar component"
              src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"/>
          </div>
        </div>

        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li>
            <a class="justify-between">
              Profile
              <span class="badge">New</span>
            </a>
          </li>
          <li><a>Settings</a></li>
          <li><a>Logout</a></li>
        </ul>

      </div>
    </div>
  </div>
</template>
