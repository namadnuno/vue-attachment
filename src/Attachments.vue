<template>
  <div class="attachments">
      <div class="uploader-panel">
        <upload-button @click="openFileDialog" :progress="progress" :sending="sending" />
        <div class="text">
            Upload Files
        </div>
        <input type="file" style="display:none;" @change="sendFile" ref="fileInput" accept=".png, .pdf, .jpg, .mp4">
      </div>
      <div class="attachments-list">
          <h6><i class="zmdi zmdi-attachment"></i> Attachments</h6>
          <ul v-if="attachments.length > 0">
              <item 
              v-for="(attachment, index) in attachments" 
              :key="'attachment-' + index" 
              :attachment="attachment" 
              @remove="() => remove(index)" />
          </ul>
          <p v-else>
              There is nothing here.
          </p>
      </div>
  </div>
</template>

<script>
import Item from "./Item";
import UploadButton from './UploadButton';
import axios from 'axios';


export default {
    components: {
        Item,
        UploadButton
    },
    props: {
        value: {
            type: Array,
            default: () => []
        },
        endpoint: {
            type: String,
            default: '/api/attachments'
        },
        headers: {
            type: Object,
            default: () => { return { "Content-Type" : "application/json" } }
        }
    },
    data() {
        return {
            attachments: this.value,
            sending: false,
            progress: 0
        }
    },
    methods: {
        openFileDialog() {
            this.$refs.fileInput.value = '';
            this.$refs.fileInput.click();
        },
        sendFile(evt) {
            if (!event.target.files[0]) {
                return;
            }

            this.sending = true;
            this.progress = 0;

            let formData = new FormData();

            formData.append('file', event.target.files[0]);

            var self = this;

            axios.post(this.endpoint, formData, {
                onUploadProgress(progressEvent) {
                    self.progress = (progressEvent.loaded * 100) / progressEvent.total;
                    console.log(self.progress);
                    self.$forceUpdate();
                }
            })
            .then(response => {
                this.attachments.push(response.data);
                this.$emit('input', this.attachments);
                this.$emit('success', response.data);
                setTimeout(() => {
                    this.sending = false;
                }, 500);
            }).catch(err => {
                console.log(err);
                this.$emit('error', err);
                this.sending = false;
            })
        },
        remove(index) {
            let file = this.attachments[index];
            this.attachments.splice(index, 1);
            this.$emit('input', this.attachments);
            this.$emit('removed', file);
        }
    }
}
</script>

<style lang="scss">
.attachments {
    margin-top: 10px;

    .attachments-list {
        margin-top: 20px;

        h6 {
            color: #005CA8;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;

            i {
                margin-right: 5px;
            }
        }

        ul {
            list-style: none;
            padding: 0px;

            li {
                font-size: 13px;

                button {
                    color: red;
                }

                color: #005CA8;
            }

        }
    }

    .uploader-panel {
        display: flex;
        align-items: center;

        .text {
            margin-left: 18px;
            font-size: 12px;
        }

        .icon {
            svg {
                width: 36px;
                path {
                    fill: #005CA8;
                }
            }
        }
    }
    .uploader {
        height: 89px;
        width: 89px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 32px;
        color: #005CA8;
        border: 2px dotted #005CA8;
        background: transparent;
        border-radius: 5px;
        position: relative;
    }
}
</style>
