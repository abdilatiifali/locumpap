<template>
    <Header
        title="Looking for a Locum"
        description="At Locumit, we want to make your life easy"
    />

    <div class="bg-white pb-12">
        <div class="mx-auto max-w-7xl px-4 py-6 pt-16 sm:px-6 lg:px-8">
            <div class="prose">
                <p>
                    At Locumit we want to make your life easy as possible when
                    it comes to finding locums.
                </p>
                <p><strong>Step 1 - </strong>Register for your free account.</p>
                <p>
                    <strong>Step 2 - </strong> Search for locums using our
                    interactive calendar.
                </p>
                <p>
                    <strong>Step 3 - </strong> Submit your request via SMS and
                    Email and wait for a locum to contact you directly.
                </p>
            </div>

            <div class="mt-8">
                <Link
                    href="/practices/register"
                    class="py-3 hover:bg-cyan-700 px-6 bg-cyan-500 text-white rounded-md shadow-lg"
                >
                    Register Now
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from "@/Shared/Header";
</script>
