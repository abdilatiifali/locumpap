<template>
	<div class="min-h-screen">
		<div
	        class="mx-auto flex max-w-4xl justify-center px-4 py-6 pt-16 sm:px-6 lg:px-8"
	    >
	        <div
	            class="w-full bg-white px-4 py-5 pb-12 shadow sm:w-2/3 sm:rounded-lg sm:px-6 sm:pt-6 sm:pb-12"
	        >
	        	<form class="space-y-4" @submit.prevent="update">
	        		<text-input :errors="form.errors.email" v-model="form.email" label="Your email" type="email" />

		        	<text-input :errors="form.errors.password" v-model="form.password" label="Your password" type="password" />

		        	<text-input :errors="form.errors.password_confirmation" v-model="form.password_confirmation" label="Confirm Your Password" type="password" />

		        	<loading-button
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
import {onMounted} from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from "@/components/TextInput"
import LoadingButton from "@/components/LoadingButton"
let props = defineProps({token: String})

onMounted(() => console.log(props.token))

const form = useForm({
	email: '',
	password: '',
	password_confirmation: '',
	token: props.token,
})

const update = () => form.post('/reset-password');

</script>