<template>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
            <div
                class="rounded-lg bg-cyan-700 px-6 py-6 md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center"
            >
                <div class="xl:w-0 xl:flex-1">
                    <h2
                        class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl"
                    >
                        Want Latest News And Updates?
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-cyan-200">
                        Sign up for our newsletter to stay up to date.
                    </p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only"
                            >Email address</label
                        >
                        <input
                            id="email-address"
                            name="email-address"
                            type="email"
                            autocomplete="email"
                            required=""
                            class="w-full rounded-md border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-cyan-700"
                            placeholder="Enter your email"
                        />
                        <button
                            type="submit"
                            class="mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-cyan-500 px-5 py-3 text-base font-medium text-white shadow hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-cyan-700 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0"
                        >
                            Notify me
                        </button>
                    </form>
                    <p class="mt-3 text-sm text-cyan-200">
                        We care about the protection of your data. Read our
                        {{ " " }}
                        <Link href="/privacy-policy" class="font-medium text-white underline">
                            Privacy Policy.
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
