import getStyleForProperty from '../process/getStyleForProperty.js';
import defaultValues from '../objects/defaultValues.js';
import trueColor from '../util/trueColor.js';
import numbers from '../interpolation/numbers.js';
import colors from '../interpolation/colors.js';
import { dropShadow, onStartFilter } from './filterEffectsBase.js';

/* filterEffects = {
  property: 'filter',
  subProperties: {},
  defaultValue: {},
  interpolators: {},
  functions = { prepareStart, prepareProperty, onStart, crossCheck }
} */

// Component Util
function replaceDashNamespace(str) {
  return str.replace('-r', 'R').replace('-s', 'S');
}

function parseDropShadow(shadow) {
  let newShadow;

  if (shadow.length === 3) { // [h-shadow, v-shadow, color]
    newShadow = [shadow[0], shadow[1], 0, shadow[2]];
  } else if (shadow.length === 4) { // ideal [<offset-x>, <offset-y>, <blur-radius>, <color>]
    newShadow = [shadow[0], shadow[1], shadow[2], shadow[3]];
  }

  // make sure the values are ready to tween
  for (let i = 0; i < 3; i += 1) {
    newShadow[i] = parseFloat(newShadow[i]);
  }
  // also the color must be a rgb object
  newShadow[3] = trueColor(newShadow[3]);
  return newShadow;
}

function parseFilterString(currentStyle) {
  const result = {};
  const fnReg = /(([a-z].*?)\(.*?\))(?=\s([a-z].*?)\(.*?\)|\s*$)/g;
  const matches = currentStyle.match(fnReg);
  const fnArray = currentStyle !== 'none' ? matches : 'none';

  if (fnArray instanceof Array) {
    for (let j = 0, jl = fnArray.length; j < jl; j += 1) {
      const p = fnArray[j].trim().split(/\((.+)/);
      const pp = replaceDashNamespace(p[0]);
      if (pp === 'dropShadow') {
        const shadowColor = p[1].match(/(([a-z].*?)\(.*?\))(?=\s(.*?))/)[0];
        const params = p[1].replace(shadowColor, '').split(/\s/).map(parseFloat);
        result[pp] = params.filter((el) => !Number.isNaN(el)).concat(shadowColor);
      } else {
        result[pp] = p[1].replace(/'|"|\)/g, '');
      }
    }
  }

  return result;
}

// Component Functions
function getFilter(tweenProp, value) {
  const currentStyle = getStyleForProperty(this.element, tweenProp);
  const filterObject = parseFilterString(currentStyle);
  let fnp;

  Object.keys(value).forEach((fn) => {
    fnp = replaceDashNamespace(fn);
    if (!filterObject[fnp]) {
      filterObject[fnp] = defaultValues[tweenProp][fn];
    }
  });

  return filterObject;
}
function prepareFilter(tweenProp, value) {
  const filterObject = {};
  let fnp;

  // property: range | default
  // opacity: [0-100%] | 100
  // blur: [0-Nem] | 0
  // saturate: [0-N%] | 100
  // invert: [0-100%] | 0
  // grayscale: [0-100%] | 0
  // brightness: [0-N%] | 100
  // contrast: [0-N%] | 100
  // sepia: [0-N%] | 0
  // 'hueRotate': [0-Ndeg] | 0
  // 'dropShadow': [0,0,0,(r:0,g:0,b:0)] | 0
  // url: '' | ''

  Object.keys(value).forEach((fn) => {
    fnp = replaceDashNamespace(fn);
    if (/hue/.test(fn)) {
      filterObject[fnp] = parseFloat(value[fn]);
    } else if (/drop/.test(fn)) {
      filterObject[fnp] = parseDropShadow(value[fn]);
    } else if (fn === 'url') {
      filterObject[fn] = value[fn];
    // } else if ( /blur|opacity|grayscale|sepia/.test(fn) ) {
    } else {
      filterObject[fn] = parseFloat(value[fn]);
    }
  });

  return filterObject;
}

function crossCheckFilter(tweenProp) {
  if (this.valuesEnd[tweenProp]) {
    Object.keys(this.valuesStart[tweenProp]).forEach((fn) => {
      if (!this.valuesEnd[tweenProp][fn]) {
        this.valuesEnd[tweenProp][fn] = this.valuesStart[tweenProp][fn];
      }
    });
  }
}

// All Component Functions
const filterFunctions = {
  prepareStart: getFilter,
  prepareProperty: prepareFilter,
  onStart: onStartFilter,
  crossCheck: crossCheckFilter,
};

// Full Component
const filterEffects = {
  component: 'filterEffects',
  property: 'filter',
  // opacity function interfere with opacityProperty
  // subProperties: [
  //   'blur', 'brightness','contrast','dropShadow',
  //   'hueRotate','grayscale','invert','opacity','saturate','sepia','url'
  // ],
  defaultValue: {
    opacity: 100,
    blur: 0,
    saturate: 100,
    grayscale: 0,
    brightness: 100,
    contrast: 100,
    sepia: 0,
    invert: 0,
    hueRotate: 0,
    dropShadow: [0, 0, 0, { r: 0, g: 0, b: 0 }],
    url: '',
  },
  Interpolate: {
    opacity: numbers,
    blur: numbers,
    saturate: numbers,
    grayscale: numbers,
    brightness: numbers,
    contrast: numbers,
    sepia: numbers,
    invert: numbers,
    hueRotate: numbers,
    dropShadow: { numbers, colors, dropShadow },
  },
  functions: filterFunctions,
  Util: {
    parseDropShadow, parseFilterString, replaceDashNamespace, trueColor,
  },
};

export default filterEffects;
