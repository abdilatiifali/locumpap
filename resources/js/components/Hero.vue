<template>
    <main>
        <div>
            <!-- Hero card -->
            <div class="relative">
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100" />
                <div class="#">
                    <div class="relative shadow-xl sm:overflow-hidden">
                        <div class="absolute inset-0">
                            <img
                                loading="eager"
                                class="h-full w-full object-cover"
                                src="/heroimage.jpeg"
                                alt="People working on laptops"
                            />
                            <div
                                class="absolute inset-0 bg-cyan-800 mix-blend-multiply"
                            />
                        </div>
                        <div
                            class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8"
                        >
                            <h1
                                class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl"
                            >
                                <span class="block text-white"
                                    >Connecting Healthcare Workers Through</span
                                >
                                <span class="block text-cyan-200"
                                    >Innovative Digital Alternatives</span
                                >
                            </h1>
                            <p
                                class="mx-auto mt-6 max-w-lg text-center text-xl text-cyan-200 sm:max-w-3xl"
                            >
                                A digital platform that provides access to a pool of qualified medical practitioners.
                            </p>
                            <div
                                class="mx-auto mt-10 max-w-sm sm:flex sm:max-w-none sm:justify-center"
                            >
                                <div
                                    class="space-y-4 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5 sm:space-y-0"
                                >
                                    <Link 
                                        class="flex items-center justify-center rounded-md border border-transparent bg-cyan-500 bg-opacity-60 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-opacity-70 sm:px-8"
                                        v-if="! $page.props.user.name"
                                        href="/register"
                                    >
                                        Sign Up
                                    </Link>

                                    <div v-if="$page.props.user.name">
                                        <Link 
                                            class="flex items-center justify-center rounded-md border border-transparent bg-cyan-500 bg-opacity-60 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-opacity-70 sm:px-8"
                                            v-if="$page.props.user.is.doctor"
                                            href="/jobs"
                                        >
                                            Available Jobs
                                        </Link>
                                        <Link
                                            class="flex items-center justify-center rounded-md border border-transparent bg-cyan-500 bg-opacity-60 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-opacity-70 sm:px-8"
                                            v-if="! $page.props.user.is.doctor"
                                            href="/dashboard/healthcare-professionals"
                                        >
                                            Available Doctors
                                        </Link>
                                    </div>
                                    
                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logo cloud -->
            <logo-cloud />
        </div>
    </main>
</template>

<script setup>
import LogoCloud from "@/components/LogoCloud"
</script>
