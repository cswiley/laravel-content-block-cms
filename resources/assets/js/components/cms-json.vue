<template>
    <div class="cms-json">
        <form action="">
            <div class="title">
                <div class="text-right">
                    <button type="button" class="button hollow default rounded" v-on:click="submit">Update Page</button>
                    <a target="_blank" v-bind:href="'/' + dataPage" class="button hollow default rounded">View Page</a>
                </div>
                <div class="success callout margin-bottom-1" data-closable="slide-out-right" v-if="success">
                    <p>Page Saved</p>
                </div>
                <div class="success callout margin-bottom-1" data-closable="slide-out-right" v-if="error">
                    <p>Page Saved</p>
                </div>
            </div>
            <h2 class="margin-bottom-1">{{dataPage}}</h2>
            <div class="panel panel-default">
                <ul class="panel-body list vertical">
                    <li v-for="(item, index) in items">
                        <div v-if="typeof item === 'string'">
                            <div class="card card-outline">
                                <div class="card-section">
                                    <ul v-if="typeof item === 'string'" class="list vertical">
                                        <li><h3>{{index}}</h3></li>
                                        <li>
                                            <cms-textarea v-bind:data-name="index" v-bind:data-value="item" v-bind:data-config="config"></cms-textarea>
                                            <!--<textarea v-bind:name="index" cols="30" rows="4">{{item}}</textarea>-->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="card card-outline">
                                <div class="card-section">
                                    <ul class="list vertical">
                                        <li><h3>{{index}}</h3></li>
                                        <li v-for="(childValue, childIndex) in item">
                                            <div v-if="typeof childValue === 'object'">
                                                <div class="card card-outline">
                                                    <div class="card-section">
                                                        <strong>#{{childIndex + 1}}</strong>
                                                        <ul class="list vertical">
                                                            <li v-for="(subChildValue, subChildIndex) in childValue">
                                                                <ul class="list vertical" v-if="typeof subChildValue === 'object'">
                                                                    <li v-for="(subSubChildValue, subSubChildIndex) in subChildValue">
                                                                        <h4>{{subSubChildIndex}}</h4>
                                                                        <cms-textarea v-bind:data-name="[index, childIndex, subChildIndex, subSubChildIndex].join('.')"
                                                                                      v-bind:data-value="subSubChildValue"
                                                                                      v-bind:data-config="config"></cms-textarea>
                                                                        <!--<textarea v-bind:name=""-->
                                                                        <!--cols="30"-->
                                                                        <!--rows="4">{{subSubChildValue}}</textarea>-->
                                                                    </li>
                                                                </ul>
                                                                <div v-else>
                                                                    <h4>{{subChildIndex}}</h4>
                                                                    <cms-textarea v-bind:data-name="[index, childIndex, subChildIndex].join('.')" v-bind:data-value="subChildValue"
                                                                                  v-bind:data-config="config"></cms-textarea>
                                                                    <!--<textarea v-bind:name="[index, childIndex, subChildIndex].join('.')" cols="30"-->
                                                                    <!--rows="4">{{subChildValue}}</textarea>-->
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <ul class="list vertical">
                                                    <li>
                                                        <h4>{{childIndex}}</h4>
                                                        <cms-textarea v-bind:data-name="[index, childIndex].join('.')" v-bind:data-value="childValue"
                                                                      v-bind:data-config="config"></cms-textarea>
                                                        <!--<textarea v-bind:name="[index, childIndex].join('.')" cols="30" rows="4">{{childValue}}</textarea>-->
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props     : ['dataPage', 'dataRoute'],
        components: ['cms-textarea'],
        data() {
            var el  = this,
                url = this.dataRoute || 'cms';
            return {
                error  : false,
                success: false,
                items  : {},
                errors : [],
                submit : function (event) {
                    var data   = $('form').serializeArray(),
                        title  = el.dataPage,
                        config = el.config;

                    axios.post('/' + url, {
                        title : title,
                        config: config,
                        data  : data
                    })
                    .then(function (response) {
                        el.success = true;
                        setTimeout(function () {
                            el.success = false;
                        }, 3000);
                    })
                    .catch(function (error) {
                        el.error = true;
                        setTimeout(function () {
                            el.error = false;
                        }, 3000);
                    });

                }

            };
        },
        created() {
            var url = this.dataRoute || 'cms';
            axios.get('/' + url + '/' + this.dataPage)
            .then(response => {
                var config  = _.pick(response.data, ['config']);
                this.config = config.config || {};
                this.items  = _.omit(response.data, ['config']);
            })
            .catch(e => {
                this.errors.push(e);
            });
        }
    };
</script>
