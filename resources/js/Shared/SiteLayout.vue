<template>
    <div class="w-full">
        <Nav />

        <div v-if="$page.props.flash.status">
            <Flash />
        </div>

        <slot />

        <Footer />
    </div>
</template>

<script setup>
import Nav from "./Nav";
import Footer from "./Footer";
import Flash from "./Flash";

</script>
