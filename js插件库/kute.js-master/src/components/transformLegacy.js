import support3DTransform from 'shorter-js/src/boolean/support3DTransform.js';
import defaultValues from '../objects/defaultValues.js';
import getInlineStyleLegacy from '../process/getInlineStyleLegacy.js';
import perspective from '../interpolation/perspective.js';
import translate3d from '../interpolation/translate3d.js';
import rotate3d from '../interpolation/rotate3d.js';
import translate from '../interpolation/translate.js';
import rotate from '../interpolation/rotate.js';
import scale from '../interpolation/scale.js';
import skew from '../interpolation/skew.js';

import { onStartLegacyTransform } from './transformLegacyBase.js';
import transformProperty from '../util/transformProperty.js';
import supportTransform from '../util/supportLegacyTransform.js';

/* transformFunctions = {
  property : 'transform',
  subProperties,
  defaultValues,
  Interpolate: {translate,rotate,skew,scale},
  functions } */

// same to svg transform, attr
// the component to handle all kinds of input values and process according to browser supported API,
// the component that handles all browsers IE9+

// Component Functions
function getLegacyTransform(tweenProperty/* , value */) {
  const currentStyle = getInlineStyleLegacy(this.element);
  return currentStyle[tweenProperty] ? currentStyle[tweenProperty] : defaultValues[tweenProperty];
}
function prepareLegacyTransform(prop, obj) {
  const prepAxis = ['X', 'Y', 'Z']; // coordinates
  const translateArray = []; const rotateArray = []; const skewArray = [];
  const transformObject = {};
  const arrayFunctions = ['translate3d', 'translate', 'rotate3d', 'skew'];

  Object.keys(obj).forEach((x) => {
    const pv = typeof (obj[x]) === 'object' && obj[x].length
      ? obj[x].map((v) => parseInt(v, 10))
      : parseInt(obj[x], 10);

    if (arrayFunctions.includes(x)) {
      if (support3DTransform) {
        if (x === 'translate3d' || x === 'rotate3d') {
          transformObject[x] = pv;
        } else if (x === 'translate') {
          transformObject.translate3d = pv.length ? pv.concat(0) : [pv || 0, 0, 0];
        } else if (x === 'rotate') {
          transformObject.rotate3d = [0, 0, pv || 0];
        } else if (x === 'skew') {
          transformObject[x] = pv.length ? pv : [pv || 0, 0];
        }
      } else if (supportTransform) {
        if (x === 'translate3d') {
          transformObject.translate = [pv[0] || 0, pv[1] || 0];
        } else if (x === 'translate' || x === 'skew') {
          transformObject[x] = pv.length ? pv : [pv || 0, 0];
        } else if (x === 'rotate3d') {
          transformObject.rotate = pv[2] || pv[1] || pv[0];
        } else if (x === 'rotate') {
          transformObject[x] = pv;
        }
      }
    } else if (/[XYZ]/.test(x)) {
      const fn = x.replace(/[XYZ]/, '');
      const fnId = fn === 'skew' || !support3DTransform ? fn : `${fn}3d`;
      const fnLen = fn === 'skew' || (!support3DTransform && fn === 'translate') ? 2 : 3;
      let fnArray = [];

      if (fn === 'translate') {
        fnArray = translateArray;
      } else if (fn === 'rotate') {
        fnArray = rotateArray;
      } else if (fn === 'skew') {
        fnArray = skewArray;
      }

      for (let fnIndex = 0; fnIndex < fnLen; fnIndex += 1) {
        const fnAxis = prepAxis[fnIndex];
        fnArray[fnIndex] = (`${fn}${fnAxis}` in obj) ? parseInt(obj[`${fn}${fnAxis}`], 10) : 0;
      }

      if (support3DTransform) {
        transformObject[fnId] = fnArray;
      } else {
        transformObject[fnId] = fn === 'rotate' ? (fnArray[2] || fnArray[1] || fnArray[0]) : fnArray;
      }
    } else if (x === 'rotate') { // 2d rotate
      const pType = support3DTransform ? 'rotate3d' : 'rotate';
      transformObject[pType] = support3DTransform ? [0, 0, pv] : pv;
    } else { // scale | perspective
      transformObject[x] = x === 'scale' ? parseFloat(obj[x]) : pv;
    }
  });

  return transformObject;
}

function crossCheckLegacyTransform(tweenProp) {
  if (this.valuesEnd[tweenProp]) {
    if (this.valuesEnd[tweenProp] && support3DTransform) {
      if (this.valuesEnd[tweenProp].perspective && !this.valuesStart[tweenProp].perspective) {
        this.valuesStart[tweenProp].perspective = this.valuesEnd[tweenProp].perspective;
      }
    }
  }
}

// All Component Functions
const transformLegacyFunctions = {
  prepareStart: getLegacyTransform,
  prepareProperty: prepareLegacyTransform,
  onStart: onStartLegacyTransform,
  crossCheck: crossCheckLegacyTransform,
};

const legacyTransformValues = {
  perspective: 400,
  translate3d: [0, 0, 0],
  translateX: 0,
  translateY: 0,
  translateZ: 0,
  translate: [0, 0],
  rotate3d: [0, 0, 0],
  rotateX: 0,
  rotateY: 0,
  rotateZ: 0,
  rotate: 0,
  skewX: 0,
  skewY: 0,
  skew: [0, 0],
  scale: 1,
};

const legacyTransformProperties = [
  'perspective',
  'translate3d', 'translateX', 'translateY', 'translateZ', 'translate',
  'rotate3d', 'rotateX', 'rotateY', 'rotateZ', 'rotate',
  'skewX', 'skewY', 'skew',
  'scale',
];

// Full Component
const transformLegacyComponent = {
  component: 'transformFunctions',
  property: 'transform',
  subProperties: legacyTransformProperties,
  defaultValues: legacyTransformValues,
  functions: transformLegacyFunctions,
  Interpolate: {
    perspective,
    translate3d,
    rotate3d,
    translate,
    rotate,
    scale,
    skew,
  },
  Util: [transformProperty],
};

export default transformLegacyComponent;
