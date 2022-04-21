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
                                    >Improving Health Outcomes</span
                                >
                                <span class="block text-cyan-200"
                                    >Through Digital</span
                                >
                            </h1>
                            <p
                                class="mx-auto mt-6 max-w-lg text-center text-xl text-cyan-200 sm:max-w-3xl"
                            >
                                We strive to provide healthcare facilities with
                                access to a pool of qualified medical
                                practitioners at a click of a button.
                            </p>
                            <div
                                class="mx-auto mt-10 max-w-sm sm:flex sm:max-w-none sm:justify-center"
                            >
                                <div
                                    class="space-y-4 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5 sm:space-y-0"
                                >
                                    <Link
                                        href="#"
                                        class="flex items-center justify-center rounded-md border border-transparent bg-white px-4 py-3 text-base font-medium text-cyan-700 shadow-sm hover:bg-cyan-50 sm:px-8"
                                        >Join Our Team</Link
                                    >
                                    <Link
                                        href="/jobs"
                                        class="flex items-center justify-center rounded-md border border-transparent bg-cyan-500 bg-opacity-60 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-opacity-70 sm:px-8"
                                        >Find Job</Link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo cloud -->
            <div class="bg-gray-100">
                <div class="mx-auto max-w-7xl py-16 px-4 sm:px-6 lg:px-8">
                    <p
                        class="text-center text-sm font-semibold uppercase tracking-wide text-gray-500"
                    >
                        Trusted by over 5 very average small businesses
                    </p>
                    <div
                        class="mt-6 grid grid-cols-2 gap-8 md:grid-cols-6 lg:grid-cols-5"
                    >
                        <div
                            class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1"
                        >
                            <img
                                class="h-12"
                                src="https://tailwindui.com/img/logos/tuple-logo-gray-400.svg"
                                alt="Tuple"
                            />
                        </div>
                        <div
                            class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1"
                        >
                            <img
                                class="h-12"
                                src="https://tailwindui.com/img/logos/mirage-logo-gray-400.svg"
                                alt="Mirage"
                            />
                        </div>
                        <div
                            class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1"
                        >
                            <img
                                class="h-12"
                                src="https://tailwindui.com/img/logos/statickit-logo-gray-400.svg"
                                alt="StaticKit"
                            />
                        </div>
                        <div
                            class="col-span-1 flex justify-center md:col-span-2 md:col-start-2 lg:col-span-1"
                        >
                            <img
                                class="h-12"
                                src="https://tailwindui.com/img/logos/transistor-logo-gray-400.svg"
                                alt="Transistor"
                            />
                        </div>
                        <div
                            class="col-span-2 flex justify-center md:col-span-2 md:col-start-4 lg:col-span-1"
                        >
                            <img
                                class="h-12"
                                src="https://tailwindui.com/img/logos/workcation-logo-gray-400.svg"
                                alt="Workcation"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
