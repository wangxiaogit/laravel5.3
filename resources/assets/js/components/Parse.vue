<template>
    <div v-html="rawhtml"></div>
</template>

<script>
    export default {
        props: {
             content: {
                type: String,
                default: ''
             }
        },
        data() {
            return {
                rawhtml: ''
            }
        },
        mounted() {
            this.rawhtml = marked(this.content);
        }
    }
</script>

