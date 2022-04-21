<template>
    <form @submit.prevent="pay" class="space-y-6">
        <div>
            <text-input
                :errors="form.errors.number"
                type="text"
                field="Your Phone Number"
                v-model="form.number"
            >
                Phone Number
            </text-input>
        </div>

        <div>
            <text-input
                :errors="form.errors.email"
                type="email"
                field="Your Email Address"
                v-model="form.email"
            >
                Email Address
            </text-input>
        </div>

        <div>
            <text-input
                :errors="form.errors.city"
                type="text"
                field="Your City"
                v-model="form.city"
            >
                City
            </text-input>
        </div>

        <div>
            <text-input
                :errors="form.errors.address"
                type="text"
                field="Your Address"
                v-model="form.address"
            >
                Address
            </text-input>
        </div>
    </form>
</template>
