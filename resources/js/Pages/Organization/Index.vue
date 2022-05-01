<template>
    <Header
        title="Looking for a Locum"
        description="At Locum Pap, we want to make your life easy"
    />

    <div class="bg-white pb-12">
        <div class="mx-auto max-w-7xl px-4 py-6 pt-16 sm:px-6 lg:px-8">
            <div class="prose">
                <p>
                    Locum Pap wants to make it easy for you to access locums when need arises. <br>Register by following these 3 simple steps.
                </p>
                <p><strong>Step 1 - </strong>Register your FREE locum pap account.</p>
                <p>
                    <strong>Step 2 - </strong> Search for locums using our
                    interactive calendar.
                </p>
                <p>
                    <strong>Step 3 - </strong> Submit your request via email,sms or directly contact the locum through their mobile phone.
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
