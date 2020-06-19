<template>

    <div class="row">
        <div class="col-md-5 col-lg-5 col-xl-4">
            <!--============ Section Title===========================================================-->
            <div id="messaging__chat-list" class="messaging__box">

                <div class="messaging__content">
                    <ul class="messaging__persons-list">

                        <template v-for="conversation in conversations">
                            <li>
                                <router-link :to="{name:'conversation', params:{id:conversation.id}}"
                                             :class="active(conversation.id)">

                                    <figure v-if="conversation.image" class="messaging__image-item"
                                            style="background-size: 100%;"
                                            :style="{ backgroundImage: ' url('  + '/uploads/users/' + conversation.image + ')' } "></figure>
                                    <figure v-else class="messaging__image-item" style="background-size: 100%;"
                                            :style="{ backgroundImage: ' url(/theme/img/author-09.jpg) ' }"></figure>

                                    <figure class="content">
                                        <h5>{{conversation.first_name}}</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut</p>
                                        <small>24 Hour Ago</small>
                                    </figure>

                                    <figure class="messaging__image-person" v-if="conversation.unread">
                                        {{conversation.unread}}
                                    </figure>

                                </router-link>
                                <!--messaging__person-->
                            </li>
                        </template>

                    </ul>
                    <!--end messaging__persons-list-->
                </div>
                <!--messaging__content-->
            </div>
            <!--end section-title-->
        </div>

        <router-view>

        </router-view>

    </div>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        props: {
            user: Number
        },

        computed: {
            ...mapGetters(['conversations']),

        },
        mounted() {


            this.$store.dispatch('loadConversations')
            this.$store.dispatch('setUser', this.user)
        },
        methods: {
            active: function (conversationID) {
                if (conversationID === this.$route.params.id) {
                    return 'messaging__person active'
                } else {
                    return 'messaging__person'
                }
            }
        }
    }
</script>
