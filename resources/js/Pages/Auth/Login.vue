<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: 'user@mail.ru',
    password: '11111111',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
<!--    <GuestLayout>-->
<!--        <Head title="Log in" />-->

<!--        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">-->
<!--            {{ status }}-->
<!--        </div>-->

<!--        <h1>Default user</h1>-->
<!--        <form @submit.prevent="submit">-->
<!--            <div>-->
<!--                <InputLabel for="email" value="Email" />-->

<!--                <TextInput-->
<!--                    id="email"-->
<!--                    type="email"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.email"-->
<!--                    required-->
<!--                    autofocus-->
<!--                    autocomplete="username"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.email" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="password" value="Password" />-->

<!--                <TextInput-->
<!--                    id="password"-->
<!--                    type="password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.password"-->
<!--                    required-->
<!--                    autocomplete="current-password"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.password" />-->
<!--            </div>-->

<!--            <div class="block mt-4">-->
<!--                <label class="flex items-center">-->
<!--                    <Checkbox name="remember" v-model:checked="form.remember" />-->
<!--                    <span class="ml-2 text-sm text-gray-600">Remember me</span>-->
<!--                </label>-->
<!--            </div>-->

<!--            <div class="flex items-center justify-end mt-4">-->
<!--                <Link-->
<!--                    v-if="canResetPassword"-->
<!--                    :href="route('password.request')"-->
<!--                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                >-->
<!--                    Forgot your password?-->
<!--                </Link>-->

<!--                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                    Log in-->
<!--                </PrimaryButton>-->
<!--            </div>-->
<!--        </form>-->
<!--    </GuestLayout>-->




    <!-- Pills content -->
    <div class="container">
        <div class="text-center mt-5">
            <Link  class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" href="/">start page</Link>
        </div>


        <div class="container-fluid w-75" style="margin-top: 100px">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control"  v-model="form.email"/>
                            <label class="form-label" for="loginName">Email or username</label>
                            <p style="color: red; font-size: 20px">{{form.errors.email}}</p>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="loginPassword" class="form-control"  v-model="form.password"/>
                            <label class="form-label" for="loginPassword">Password</label>
                            <p style="color: red; font-size: 20px">{{form.errors.password}}</p>
                        </div>

                        <!-- 2 column grid layout -->
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0">
                                    <checkbox  class="form-check-input" v-model:checked="form.remember"/>
                                    <label class="form-check-label" > Remember me </label>
                                </div>
                            </div>

                        </div>

                        <!-- Submit button -->
                        <PrimaryButton class="btn btn-primary btn-block mb-4 font-semibold text-xl text-white w-50" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="margin: auto; height: 50px" @click.prevent="submit">
                            Log in
                        </PrimaryButton>

                    </form>
                </div>
            </div>
        </div>


    </div>
</template>



