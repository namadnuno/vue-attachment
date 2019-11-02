import Vue from 'vue';
import VueAttachments from '../index';
import Item from '../Item.vue';

Vue.use(VueAttachments)

export default { title: 'Attachments' };

const attachments = [
    'image.jpg',
    'file.pdf',
];

export const VueAttachmentsComponent = () => '<v-attachment />';
export const VueAttachmentsComponentWithAttachments = () => ({
    data() {
        return {
            attachments
        }
    },
    template: '<v-attachment v-model="attachments" />'
});
export const itemComponent = () => ({
    components: { Item },
    template: '<item attachment="file.jpg" />'
  });
