<template>
    <div>
        <div class="bg-loading">
            <div class="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h3>Loading ...</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loading",
}
</script>

<style lang="scss">

.bg-loading{
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba($color: white, $alpha: .5);
    z-index: 1;
}

.loading{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 2;

    .spinner-border{
        width: 200px;
        height: 200px;
    }
    h3{
        text-align: center;
        margin-top: 25px;
    }
}

</style>