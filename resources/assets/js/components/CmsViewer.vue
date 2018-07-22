<template>
    <div class="cms-viewer">
        {{ data }}
        <div v-for="(val, key) in fields">
            <label>{{key}}</label>
            <input v-model="fields[key]" type="text">
        </div>

        <button type="button" class="primary button" @click.prevent="save">Save</button>
    </div>

</template>

<script>
    export default {
        name   : "cms-viewer",
        data() {
            let vue = this;

            $.get('/api/cms/test', function (response) {
                vue.fields = vue.dot(response);
            });

            var test = {};
            return {
                fields: {}
            };
        },
        methods: {
            dot      : function (data, prepend) {
                var res = {},
                    key;

                prepend = (prepend || '') ? prepend + '.' : '';

                // console.log(data);
                for (key in data) {
                    if (data.hasOwnProperty(key)) {
                        if (typeof data[key] === 'object') {
                            $.extend(res, this.dot(data[key], prepend + key));
                        }
                        else {
                            res[prepend + key] = data[key];
                        }
                    }
                }

                return res;
            },
            setDot : function (res, index, value) {
                if (!index) return;
                var keys = index.split('.'),
                    w,
                    ii,
                    jj;

                for (ii = 0; ii < keys.length - 1; ii++) {
                    if (res.hasOwnProperty(keys[ii])) {
                        res = res[keys[ii]];
                    }
                    else {
                        for (jj = keys.length - 1; ii <= jj; jj--) {
                            w       = value;
                            value       = {};
                            value[keys[jj]] = w;
                        }
                        res[keys[ii]] = value[keys[ii]];
                        return;
                    }
                }
                res[keys[ii]] = value;
            },
            save     : function () {
                let vue = this,
                    res = {};

                _.each(this.fields, function (value, key) {
                    vue.setDot(res, key, value);
                });

                console.log(res);
            }
        }
    };
</script>

<style scoped>

</style>