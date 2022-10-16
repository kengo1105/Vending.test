const { styles } = require("laravel-mix");

styles
function checkDelete() {
    if(!window.confirm('本当に削除してよろしいですか？')) {
        return false;
    }
}