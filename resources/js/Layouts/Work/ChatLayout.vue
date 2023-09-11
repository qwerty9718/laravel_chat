<template>
    <div class="main-content" id="panel">

        <!--  Navbar  -->
        <slot name="navbar"></slot>


        <div class="container-fluid pt-3">
            <div class="row removable">
                <div class="col-lg-12 px-sm-0">
                    <div class="card shadow-none px-0 bg-transparent mt-0 mb-4">
                        <div class="card-body px-0 pb-0">
                            <div class="px-0 pb-4">
                                <div class="container-fluid">
                                    <div class="row flex-row">

                                        <!--  Контакты  -->
                                        <slot name="contacts"></slot>

                                        <div class="col-lg-8">
                                            <div class="card" style="height: 70vh;">

                                                <!--  С кем переписка-->
                                                <slot name="secondUserInfoBlock"></slot>

                                                <!--  Сообщения  -->
                                                <slot name="messages"></slot>

                                                <!--  Отправка Сообщений -->
                                                <slot name="sendMessage"></slot>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";


export default {
    name: "ChatLayout",
    components:{Link}
}
</script>

<style scoped>

</style>
