<template>
    <Header title="I'm a Locum" description="Locum pap makes it easy for you" />

    <div class="bg-white pb-12">
        <div class="mx-auto max-w-7xl px-4 py-6 pt-16 sm:px-6 lg:px-8">
            <div class="prose">
                <p>
                    Finding locum work can be stressful and challenging but
                    Locum pap will connect you with kenya healthcare
                    organisations easily and efficiently. All you need to do is
                    complete our simple registration process and select the
                    geographical areas you want to work in. Locum Pap will match
                    your profile with healthcare organisations relevant to your
                    profession and geographical area(s). You will receive an SMS
                    and Email from a relevant healthcare organisation looking
                    for a locum and you can contact them directly if interested.
                </p>

                <p>
                    <strong>Step 1 - </strong> Register for your free account
                    and modify your profile / availability in secure members
                    area.
                </p>
                <p>
                    <strong>Step 2 - </strong> Wait to receive an SMS and Email
                    from healthcare organisations looking for a locum.
                </p>
                <p>
                    <strong>Step 3 - </strong> Contact the healthcare
                    organisation directly if you are interested and negotiate
                    your own pay rate.
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
