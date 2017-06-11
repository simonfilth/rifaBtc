<template  id="panel-template">
    <div class="col-lg-3 col-md-6">
        <div :class="panelColor">
            <div class="panel-heading">
                <a @click="addRemoveTable" class="href-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i :class="faStyle"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">@{{hugePanel}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">@{{mensajePanel}}</div>
                    </div> 
                </a> 
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>