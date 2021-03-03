<template>
    <div>
        <label class="mb-0">
            <span class="btn btn-blue-grey btn-sm" style="margin: 0; padding: 4px;">
                写真を選ぶ
                <input type="file" name="img" ref="filename" style="display:none" 
                    @change="getFileName"
                >
            </span>
        </label>
        <div v-if="fileName" class="my-2">
            <img class="img-fluid d-block mx-auto"
                :src="fileName"
            >
        </div>
        <div class="md-form pt-0" style="margin: 0;">
            <input type="text" class="form-control pt-0" readonly
                :value="inputImg"
            >
        </div>
    </div>
</template>

<script>
export default {
    props: {
        initialFileName: {
            type: String,
            default: null,
        }, 
        initialArticleUserId: {
            type: Number,
            default: null,
        }, 
    }, 
    data: function() {
        let path = '';
        if (this.initialArticleUserId && this.initialFileName) {
            path = '/storage/images/' + String(this.initialArticleUserId) + '/' + this.initialFileName;
        }
        return {
            fileName: path, 
        }
    }, 
    methods: {
        getFileName() {
            const input = this.$refs.filename.files[0];
            this.inputImg = input.name;
            this.fileName = URL.createObjectURL(input);
        }, 
    }, 
}
</script>