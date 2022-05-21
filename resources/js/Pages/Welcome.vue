<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-white">
        <Hero :image="heroImageUrl" />
    </div>

     <div v-if="! $page.props.user.name" class="relative pt-8 pb-32">
        <div class="px-4 sm:px-0 relative z-10 mx-auto max-w-7xl">
            <Features />
        </div>
    </div>

    <About :image="testimonialImageUrl" />

    <Contact />

    <NewsLetter />

</template>

<script setup>
import About from "@/components/About";
import Hero from "@/components/Hero";
import Contact from "@/components/Contact";
import Features from "@/components/Features";
import NewsLetter from "@/components/NewsLetter";

defineProps({
    heroImageUrl: String,
    testimonialImageUrl: String,
})
</script>
