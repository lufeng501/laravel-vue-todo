import $ from 'jquery'

export function test() {
  console.log('面向过程写法=======')
  console.log('test...')
}

/**
 * 判断变量是否为空
 * @param {Number}{String} data
 */
export function isNull(data) {
  if (data == "" || data == undefined || data == null || data == "false") {
    return true;
  } else {
    return false;
  }
}