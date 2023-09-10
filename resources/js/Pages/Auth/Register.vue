<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
<!--    <GuestLayout>-->
<!--        <Head title="Register" />-->

<!--        <form @submit.prevent="submit">-->
<!--            <div>-->
<!--                <InputLabel for="name" value="Name" />-->

<!--                <TextInput-->
<!--                    id="name"-->
<!--                    type="text"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.name"-->
<!--                    required-->
<!--                    autofocus-->
<!--                    autocomplete="name"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.name" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="email" value="Email" />-->

<!--                <TextInput-->
<!--                    id="email"-->
<!--                    type="email"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.email"-->
<!--                    required-->
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
<!--                    autocomplete="new-password"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.password" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="password_confirmation" value="Confirm Password" />-->

<!--                <TextInput-->
<!--                    id="password_confirmation"-->
<!--                    type="password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.password_confirmation"-->
<!--                    required-->
<!--                    autocomplete="new-password"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.password_confirmation" />-->
<!--            </div>-->

<!--            <div class="flex items-center justify-end mt-4">-->
<!--                <Link-->
<!--                    :href="route('login')"-->
<!--                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                >-->
<!--                    Already registered?-->
<!--                </Link>-->

<!--                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                    Register-->
<!--                </PrimaryButton>-->
<!--            </div>-->
<!--        </form>-->
<!--    </GuestLayout>-->








    <div class="container">
        <div class="text-center mt-5">
            <Link  class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" href="/">start page</Link>
        </div>


        <div class="container-fluid w-75" style="margin-top: 50px">
            <div class="tab-pane" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form>

                    <!-- Name input -->
                    <div class="form-outline mb-2">
                        <input type="text" id="registerName" class="form-control" v-model="form.name"/>
                        <label class="form-label" for="registerName">Name</label>
                        <p style="color: red; font-size: 20px">{{form.errors.name}}</p>
                    </div>


                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <input type="email" id="registerEmail" class="form-control"  v-model="form.email"/>
                        <label class="form-label" for="registerEmail">Email</label>
                        <p style="color: red; font-size: 20px">{{form.errors.email}}</p>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <input type="password" id="registerPassword" class="form-control"  v-model="form.password" />
                        <label class="form-label" for="registerPassword">Password</label>
                        <p style="color: red; font-size: 20px">{{form.errors.password}}</p>
                    </div>

                    <!-- Repeat Password input -->
                    <div class="form-outline mb-2">
                        <input type="password" id="registerRepeatPassword" class="form-control" v-model="form.password_confirmation"/>
                        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                        <p style="color: red; font-size: 20px">{{form.errors.password_confirmation}}</p>
                    </div>


                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>
                    <!-- Submit button -->
                    <PrimaryButton class="btn btn-primary btn-block mb-4 font-semibold text-xl text-white w-50" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="margin: auto; height: 50px;" @click.prevent="submit">
                        Sign in
                    </PrimaryButton>
                </form>
            </div>
        </div>


    </div>
    <!-- Pills content -->
</template>
