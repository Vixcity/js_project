/*
 * IE低版本提示信息
 */
window.onload = function() {
    var rootEl = document.body;
    var wrapEl = document.createElement('div');
    wrapEl.className = 'ie-update';
    var cont = document.createElement('div');
    cont.className = 'container text-center';
    cont.innerHTML = '<p>很抱歉，您的浏览器版本过低，可能无法正常使用我们的网站。推荐使用 <a target="_blank" class="ie-update-url" href="http://www.google.cn/intl/zh-CN/chrome/">Chrome浏览器</a> 或者 <a target="_blank" class="ie-update-url" href="http://windows.microsoft.com/ie">升级您的浏览器</a> 。</p>';
    wrapEl.appendChild(cont);
    rootEl.insertBefore(wrapEl, rootEl.firstChild);
    rootEl.style.marginTop = '50px';
    rootEl.style.fontSize = '14px';
}