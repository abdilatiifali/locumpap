<template>
	<div class="min-h-screen">
		<div
	        class="mx-auto flex max-w-4xl justify-center px-4 py-6 pt-16 sm:px-6 lg:px-8"
	    >
	        <div
	            class="w-full bg-white px-4 py-5 pb-12 shadow sm:w-2/3 sm:rounded-lg sm:px-6 sm:pt-6 sm:pb-12"
	        >
	        	<form class="" @submit.prevent="reset">
		        	<text-input :errors="form.errors.email" v-model="form.email" label="Your Email" type="email" />

		        	<loading-button
		        		class="mt-4"
		                :loading="form.processing"
		                :disable="form.processing"
		            >
		               Reset Password
		            </loading-button>
		        </form>
	    	</div>

	    </div>
	</div>


</template>

<script setup>
import TextInput from "@/components/TextInput"
import { useForm } from "@inertiajs/inertia-vue3";
import LoadingButton from "@/components/LoadingButton";

const form = useForm({
	email: '',
})

const reset = () => form.post('/forgot-password');


</script>