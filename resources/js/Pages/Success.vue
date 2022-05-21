<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <main
        class="min-h-screen bg-gray-100 px-4 pt-16 pb-24 sm:px-6 sm:pt-24 lg:px-8 lg:py-32"
    >
        <div class="mx-auto max-w-3xl">
            <div class="max-w-xl">
                <h1
                    class="text-sm font-semibold uppercase tracking-wide text-indigo-600"
                >
                    Thank you!
                </h1>
                <p
                    class="mt-2 text-4xl font-extrabold tracking-tight sm:text-5xl"
                >
                    You Applied The job!
                </p>
                <p class="mt-2 text-base text-gray-500">
                    We will Notify You via email if you have been selected for
                    the job
                </p>

                <dl class="mt-12 text-sm font-medium">
                    <dt class="text-gray-900">Check out related Jobs</dt>
                    <dd class="mt-2 text-indigo-600">
                        <Link href="/jobs"> Related Jobs </Link>
                    </dd>
                </dl>
            </div>
        </div>
    </main>
</template>
