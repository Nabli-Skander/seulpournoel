<template>
    <div class="col-md-7 col-lg-7 col-xl-8">
        <div id="messaging__chat-window" class="messaging__box">
            <div class="messaging__header">
                <div class="float-left flex-row-reverse messaging__person">
                    <h5 class="font-weight-bold">{{name}}</h5>
                    <figure class="mr-4 messaging__image-person" :style="imageTakeUser"
                    ></figure>
                </div>
                <div class="float-right messaging__person">
                    <h5 class="mr-4">Moi</h5>
                    <figure id="messaging__user" class="messaging__image-person" :style="imageMe"
                    ></figure>
                </div>
            </div>

            <div id="scrollBot" class="messaging__content" data-background-color="rgba(0,0,0,.05)">
                <div class="messaging__main-chat">
                    <Message :key="message.id" v-for="message in messages" :message="message" :user="user"/>
                </div>
            </div>
        </div>
        <div class="messaging__footer">
            <form class="form" action="" method="post">
                <div style="flex-wrap: wrap;" class="input-group">
                    <textarea style="width: 100%;resize:none;"
                              :class="{'form-control ' : true, 'is-invalid': errors.content}" v-model="content"
                              @keypress.enter="sendMessage" autocomplete="off" placeholder="Message"></textarea>
                    <div class="invalid-feedback" v-if="errors.content"> {{ errors.content.join(', ') }}</div>
                    <!--<input type="text" class="form-control mr-4" v-model="content" @keypress.enter="sendMessage" autocomplete="off" placeholder="Message">-->
                    <!--<div class="input-group-append">-->
                    <!--&lt;!&ndash;<button class="btn btn-primary" type="submit">&ndash;&gt;-->
                    <!--&lt;!&ndash;<i class="fa fa-send"></i>&ndash;&gt;-->
                    <!--&lt;!&ndash;</button>&ndash;&gt;-->
                    <!--</div>-->
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Message from './MessageComponent'
    import {mapGetters} from 'vuex'

    export default {
        components: {Message},
        data() {
            return {
                content: '',
                errors: {}
            }
        },
        computed: {
            ...mapGetters(['user']),
            ...mapGetters(['conversation']),
            // ...mapGetters(['takeUser']),
            ...mapGetters(['me']),
            messages: function () {
                return this.$store.getters.messages(this.$route.params.id)
            },
            lastMessages: function () {
                return this.messages[this.messages.length - 1]
            },
            name: function () {
                return this.$store.getters.conversation(this.$route.params.id).first_name
            },
            count: function () {
                return this.$store.getters.conversation(this.$route.params.id).count
            },
            // backgroundImage(){
            //         return "background-image: url('"+this.image()+"'); background-size: cover; "
            // },
            imageTakeUser() {
                if (this.$store.getters.conversation(this.$route.params.id).image != null || undefined) {
                    return "background-image: url('/uploads/users/" + this.$store.getters.conversation(this.$route.params.id).image + "'); background-size: cover; "
                } else {
                    return "background-image: url('/theme/img/author-09.jpg'); background-size: cover; "
                }
            },
            imageMe() {
                if (this.me.image != null || undefined) {

                    return "background-image: url('/uploads/users/" + this.me.image + "'); background-size: cover; "
                } else {
                    return "background-image: url('/theme/img/author-09.jpg'); background-size: cover; "
                }
            },
        },
        mounted() {
            this.loadMessages()
            this.$scroll = this.$el.querySelector('#scrollBot')
            document.addEventListener('visibilitychange', this.onVisible)
        },
        destroyed() {

            document.removeEventListener('visibilitychange', this.onVisible)

        },
        watch: {
            '$route.params.id': function () {
                this.loadMessages()
            },
            lastMessages: function () {
                this.scrollBot()
            }
        },
        methods: {
            onVisible() {
                if (document.hidden === false) {
                    this.$store.dispatch('loadMessages', this.$route.params.id)
                }
            },
            async loadMessages() {
                let response = await this.$store.dispatch('loadMessages', this.$route.params.id)

                if (this.messages.length < this.count) {
                    this.$scroll.addEventListener('scroll', this.onScroll)
                }
            },
            async onScroll() {
                if (this.$scroll.scrollTop === 0) {
                    this.$scroll.removeEventListener('scroll', this.onScroll)
                    let previousHeight = this.$scroll.scrollHeight
                    await this.$store.dispatch('loadPreviousMessages', this.$route.params.id)
                    this.$nextTick(() => {
                        this.$scroll.scrollTop = this.$scroll.scrollHeight - previousHeight
                    })
                    if (this.messages.length < this.count) {
                        this.$scroll.addEventListener('scroll', this.onScroll)
                    }
                }
            },
            scrollBot() {
                this.$nextTick(() => {
                    this.$scroll.scrollTop = this.$scroll.scrollHeight
                })
            },
            async sendMessage(e) {
                if (e.shiftKey === false) {
                    this.errors = {}
                    e.preventDefault()
                    try {
                        await this.$store.dispatch('sendMessage', {
                            content: this.content,
                            userId: this.$route.params.id
                        })
                        this.content = ''
                    } catch (e) {
                        if (e.errors) {
                            this.errors = e.errors
                        } else {
                            console.log(e)
                        }
                    }

                }
            }
        }
    }
</script>
