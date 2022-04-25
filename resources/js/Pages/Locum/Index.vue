<template>
    <Header title="I'm a Locum" description="Locum pap makes it easy for you" />

    <div class="bg-white pb-12">
        <div class="mx-auto max-w-7xl px-4 py-6 pt-16 sm:px-6 lg:px-8">
            <div class="prose">
                <p>
                   Finding locums can be challenging but Locum Pap is here to help solve that for you. All you need to do is complete our simple registration steps. Locum Pap will match your profile with healthcare institutions relevant to your profession and counties. You will receive an SMS, Email or phone call from an interested institution, comply and you’re good to go.&nbsp; Register by following these 2 simple steps.
                </p>

                <p>
                    <strong>Step 1 - </strong> Register your FREE locum pap account and modify your profile as you go.
                </p>
                <p>
                    <strong>Step 2 - </strong> Wait to receive an SMS and Email
                    from healthcare institutions looking for a locum.
                </p>
               
            </div>
            <div class="mt-8">
                <Link
                    href="/locum/register"
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
import Button from "@/components/Button";
</script>
