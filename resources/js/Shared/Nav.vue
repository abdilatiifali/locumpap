<template>
    <header>
        <Popover class="relative bg-white">
            <div
                class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 md:justify-start md:space-x-10 lg:px-8"
            >
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <Link href="/">
                        <span class="sr-only">Locum Pap</span>
                        <img
                            loading="eager"
                            class="h-6 w-auto"
                            :src="$page.props.logoUrl"
                            alt="Locum Pap"
                        />
                    </Link>
                </div>
                <div v-if="! user.name" class="-my-2 -mr-2 md:hidden">
                    <PopoverButton
                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500"
                    >
                        <span class="sr-only">Open menu</span>
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                </div>
                <PopoverGroup as="nav" class="hidden space-x-10 md:flex">
                    <Link
                        href="/im-a-locum"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        Locums
                    </Link>

                    <Link
                        v-if="!user.name"
                        href="looking-for-a-locum"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        Looking For locum
                    </Link>

                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        {{ item.name }}
                    </Link>
                </PopoverGroup>
                <div
                    class="hidden items-center justify-end md:flex md:flex-1 lg:w-0"
                >
                    <div v-if="!user.name">
                        <Link
                            href="/login"
                            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                            >Login</Link
                        >
                        <Link
                            href="/register"
                            class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-cyan-700"
                        >
                            Sign up
                        </Link>
                    </div>
                </div>

                <div v-if="user.name">
                    <Link
                        v-if="user.can.postJobs"
                        href="/jobs/create"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        Post Job
                    </Link>

                    <Link
                        v-if="user.is.doctor"
                        href="/profile"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        Drop Cv
                    </Link>

                    <Link
                        href="/jobs"
                        class="ml-8 sm:hidden text-base font-medium text-gray-500 hover:text-gray-900"
                    >
                        Locums
                    </Link>

                </div>

                <div v-if="user.name">
                    <Menu as="div" class="relative flex-shrink-0 ml-4">
                      <div>
                        <MenuButton class="rounded-full flex text-sm text-white focus:outline-none focus:bg-cyan-900 focus:ring-2 focus:ring-offset-2 focus:ring-offset-cyan-900 focus:ring-white">
                          <span class="sr-only">Open user menu</span>
                          <img class="rounded-full h-8 w-8" :src="user.avatar" alt="User profile photo" />
                        </MenuButton>
                      </div>
                      <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                        <MenuItems class="z-10 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                          <MenuItem as="div">
                             <MenuItem as="div">
                            <Link v-if="user.can.viewProfile" href="/profile" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">Your Profile
                            </Link>
                            <Link v-if="user.can.postJobs" href="/dashboard" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">Dashboard
                            </Link>
                            
                            <Link v-if="user.can.postJobs" href="/events" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">Trainings
                            </Link>

                          </MenuItem>

                            <Link as="button" method="delete" href="/logout" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">Logout
                            </Link>
                          </MenuItem>

                        </MenuItems>
                      </transition>
                    </Menu>
                </div>
            </div>

            <transition
                enter-active-class="duration-200 ease-out"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="duration-100 ease-in"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
            >
                <PopoverPanel
                    focus
                    class="absolute inset-x-0 top-0 z-30 origin-top-right transform p-2 transition md:hidden"
                >
                    <div
                        class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                    >
                        <div class="px-5 pt-5 pb-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <img
                                        class="h-6 w-auto"
                                        :src="$page.props.logoUrl"
                                        alt="Locum Pap"
                                    />
                                </div>

                                <div class="-mr-2">
                                    <PopoverButton
                                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500"
                                    >
                                        <span class="sr-only">Close menu</span>
                                        <XIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </PopoverButton>
                                </div>
                            </div>
                        </div>
                        <div class="py-6 px-5">
                            <PopoverGroup as="nav">
                                <div class="grid grid-cols-2 gap-4">
                                    <a

                                        v-for="item in navigation"
                                        :key="item.name"
                                        :href="item.href"
                                        class="text-base font-medium text-gray-900 hover:text-gray-700"
                                    >
                                        {{ item.name }}
                                    </a>
                                </div>
                                <div class="mt-6">
                                    <a
                                        href="/register"
                                        class="flex w-full items-center justify-center rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-cyan-700"
                                    >
                                        Sign up
                                    </a>
                                    <p
                                        class="mt-6 text-center text-base font-medium text-gray-500"
                                    >
                                        Existing customer?
                                        <a href="/login" class="text-gray-900">
                                            Sign in
                                        </a>
                                    </p>
                                </div>

                            </PopoverGroup>
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </header>
</template>

<script setup>
import {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from "@headlessui/vue";

import { DotsVerticalIcon } from "@heroicons/vue/solid";
import { MenuIcon, XIcon } from "@heroicons/vue/outline";
import { onMounted, computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const navigation = [
    { name: "Training & Events", href: "/events" },
    { name: "About Locum Pap", href: "/#about" },
    { name: "Contact Us", href: "/#contact" },
];

const userNavigation = [
  { name: 'Your Profile', href: '/profile' },
  { name: 'Sign out', href: '/logout' },
]

const user = usePage().props.value.user;
const can = usePage().props.value.can;
</script>
