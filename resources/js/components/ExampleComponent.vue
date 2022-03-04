<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Vue Component</div>

                    <div class="card-body">

                        You are logged in!

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            var people = [
                { name: "Nedd", surname: "Stark" },
                { name: "Robb", surname: "Stark" }
            ]
            console.table(people)
        }
    }
</script>
