<template>
    <div :class="cls">

        <p>
            {{ message.content }}
            <small>{{ago}}</small>
        </p>

    </div>

</template>


<!--<div class="messaging__main-chat__bubble row user ">-->
<!--<p>-->
<!--{{ messages }}-->
<!--<small>24 hour ago</small>-->
<!--</p>-->

<!--<div class="author">-->
<!--<div class="author-image">-->
<!--<div class="background-image">-->
<!--<img src="" alt="">-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

<script>
    import moment from 'moment'
    moment.locale('fr')

    export default {
        props: {
            message : Object,
            user: Number
        },
        computed : {

            cls(){
                let cls = ['messaging__main-chat__bubble'];
                if (this.message.from_id === this.user){
                    cls.push('user')
                }
                return cls
            },
            ago(){
                return moment(this.message.created_at).fromNow()
            },
            backgroundImage(){
                    return "background-image: url('"+this.image+"') "
            },
            image(){
                if (this.message.from.image !== null){
                    return "/uploads/users/" + this.message.from.image
                }else{
                    return "/theme/img/author-09.jpg"
                }
            }
        }
    }
</script>
