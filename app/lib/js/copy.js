function Copiar(element) {
  var temp = document.createElement('textarea');
  document.getElementsByTagName('body')[0].appendChild(temp);
  temp.value = element.innerHTML;
  temp.select();
  document.execCommand('copy');
  document.getElementsByTagName('body')[0].removeChild(temp);
}
