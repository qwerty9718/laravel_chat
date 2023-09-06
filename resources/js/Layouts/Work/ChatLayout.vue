<template>
    <div class="main-content" id="panel">
        <div class="container-fluid pt-3">
            <div class="row removable">
                <div class="col-lg-12 px-sm-0">
                    <div class="card shadow-none px-0 bg-transparent mt-0 mb-4">
                        <div class="card-body px-0 pb-0">
                            <div class="px-0 pb-4">
                                <div class="container-fluid">
                                    <Link :href="route('dashboard')">dashboard</Link>
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
export default {
    name: "ChatLayout"
}
</script>

<style scoped>

</style>
