import hexToRGB from './hexToRGB.js';

// trueColor - replace transparent and transform any color to rgba()/rgb()
export default function trueColor(colorString) {
  let result;
  if (/rgb|rgba/.test(colorString)) { // first check if it's a rgb string
    const vrgb = colorString.replace(/\s|\)/, '').split('(')[1].split(',');
    const colorAlpha = vrgb[3] ? vrgb[3] : null;
    if (!colorAlpha) {
      result = { r: parseInt(vrgb[0], 10), g: parseInt(vrgb[1], 10), b: parseInt(vrgb[2], 10) };
    }
    result = {
      r: parseInt(vrgb[0], 10),
      g: parseInt(vrgb[1], 10),
      b: parseInt(vrgb[2], 10),
      a: parseFloat(colorAlpha),
    };
  } if (/^#/.test(colorString)) {
    const fromHex = hexToRGB(colorString);
    result = { r: fromHex.r, g: fromHex.g, b: fromHex.b };
  } if (/transparent|none|initial|inherit/.test(colorString)) {
    result = {
      r: 0, g: 0, b: 0, a: 0,
    };
  }
  if (!/^#|^rgb/.test(colorString)) { // maybe we can check for web safe colors
    const siteHead = document.getElementsByTagName('head')[0];
    siteHead.style.color = colorString;
    let webColor = getComputedStyle(siteHead, null).color;
    webColor = /rgb/.test(webColor) ? webColor.replace(/[^\d,]/g, '').split(',') : [0, 0, 0];
    siteHead.style.color = '';
    result = {
      r: parseInt(webColor[0], 10),
      g: parseInt(webColor[1], 10),
      b: parseInt(webColor[2], 10),
    };
  }
  return result;
}
