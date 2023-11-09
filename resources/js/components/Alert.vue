<template>
<div :class="estilo" role="alert">
feedback
{{ tipo }}
</div>
</template>

<script>
    export default {
        props: ['tipo'],
        computed: {
            estilo() {
                return 'alert alert-'+this.tipo
            }
        }
    }
</script>
