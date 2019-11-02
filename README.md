# vue-attachment

> An Attachement component for Vue.js

<center>
    <p>
        <img src="preview.png" alt="Preview" width="400">
    </p>
</center>

<p>
  <a href="https://www.npmjs.com/package/vue-attachment"><img src="https://img.shields.io/npm/v/vue-attachment.svg" alt="Version"></a>
  <a href="https://www.npmjs.com/package/vue-attachment"><img src="https://img.shields.io/npm/dm/vue-attachment.svg" alt="Downloads"></a>
  <a href="https://www.npmjs.com/package/vue-attachment"><img src="https://img.shields.io/npm/l/vue-attachment.svg" alt="License"></a>
</p>

This component provides an simple and out-of-box experience for file attachments.

## Installation

```
yarn add vue-attachment
```
or

```
npm i vue-attachment --save
```

## Demo

> There is an simple example on the **/demo** folder. 
[HERE](https://github.com/namadnuno/vue-attachment/tree/master/demo)

## Usage

Import Globally:

```
import Vue from 'vue'

import VueAttachment from 'vue-attachment'

Vue.use(VueAttachment)
```

Import as a Component:

```
import VueAttachment from 'vue-attachment'


...
{ 
    components: { VueAttachment }
}
...
```

### Example
```
<template>
    <form @submit.prevent="submit">
        <v-attachment v-model="attachments" endpoint="/upload.php" />
    </form>
</template>
<script>
    export default {
        data() {
            return {
                attachments: [
                    'file.pdf',
                    'image.jpg'
                ]
            }
        }
    },
    methods: {
        submit() {
            ....
        }
    }
</script>
```

### Properties

| Name                    | Type     | Required | Default         | Info                                                                        |
| ----------------------- | -------- | -------- | --------------- | --------------------------------------------------------------------------- |
| **value**               | Array    | False    | []              | List of files imported (v-model when binding is important)                  |
| **endpoint**            | String   | False    | upload.php      | Upload Endpoint              |

### Events

| Name         | Params                           | Info                                                                       |
| ------------ | -------------------------------- | -------------------------------------------------------------------------- |
| **success**  | server message                   | Triggered after sending file with success                                  |
| **error**    | server message                   | Triggered after sending file without success                               |
| **removed**  | filename                         | Triggered when a file is remove                                                     |
| **input**    | attachments                      | Triggered after a change on attachments files                              |

## License

[MIT License](http://en.wikipedia.org/wiki/MIT_License)
