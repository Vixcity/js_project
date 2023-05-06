<template>
  <div class="containers" ref="content">
    <div class="canvas" ref="canvas"></div>
    <div id="js-properties-panel" class="panel"></div>
  </div>
</template>

<script>
// 引入相关的依赖
// import BpmnViewer from 'bpmn-js'
import BpmnModeler from 'bpmn-js/lib/Modeler'
import propertiesPanelModule from 'bpmn-js-properties-panel'
import propertiesProviderModule from 'bpmn-js-properties-panel/lib/provider/camunda'
import camundaModdleDescriptor from 'camunda-bpmn-moddle/resources/camunda'
export default {
  name: '',
  components: {},
// 生命周期 - 创建完成（可以访问当前this实例）
  created() {},
// 生命周期 - 载入后, Vue 实例挂载到实际的 DOM 操作完成，一般在该过程进行 Ajax 交互
  mounted() {
    this.init()
  },
  data() {
    return {
        // bpmn建模器
        bpmnModeler: null,
        container: null,
        canvas: null
    }
  },
// 方法集合
  methods: {
    init () {
      // 获取到属性ref为“content”的dom节点
      this.container = this.$refs.content
      // 获取到属性ref为“canvas”的dom节点
      const canvas = this.$refs.canvas
      // 建模
      this.bpmnModeler = new BpmnModeler({
        container: canvas,
        //添加控制板
        propertiesPanel: {
          parent: '#js-properties-panel'
        },
        additionalModules: [
          // 左边工具栏以及节点
          propertiesProviderModule,
          // 右边的工具栏
          propertiesPanelModule
        ],
        moddleExtensions: {
          camunda: camundaModdleDescriptor
        }
      })
      this.createNewDiagram()
	},
    createNewDiagram () {
        // 将字符串转换成图显示出来
        this.bpmnModeler.importXML(`<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdi="http://www.omg.org/spec/DD/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" isExecutable="false">
    <startEvent id="StartEvent_1y45yut" name="开始">
    <outgoing>SequenceFlow_0h21x7r</outgoing>
    </startEvent>
    <task id="Task_1hcentk">
    <incoming>SequenceFlow_0h21x7r</incoming>
    </task>
    <sequenceFlow id="SequenceFlow_0h21x7r" sourceRef="StartEvent_1y45yut" targetRef="Task_1hcentk" />
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
    <bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
    <bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
        <omgdc:Bounds x="152" y="102" width="36" height="36" />
        <bpmndi:BPMNLabel>
        <omgdc:Bounds x="160" y="145" width="22" height="14" />
        </bpmndi:BPMNLabel>
    </bpmndi:BPMNShape>
    <bpmndi:BPMNShape id="Task_1hcentk_di" bpmnElement="Task_1hcentk">
        <omgdc:Bounds x="240" y="80" width="100" height="80" />
    </bpmndi:BPMNShape>
    <bpmndi:BPMNEdge id="SequenceFlow_0h21x7r_di" bpmnElement="SequenceFlow_0h21x7r">
        <omgdi:waypoint x="188" y="120" />
        <omgdi:waypoint x="240" y="120" />
    </bpmndi:BPMNEdge>
    </bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>`, (err) => {
            if (err) {
                // console.error(err)
            }
            else {
                // 这里是成功之后的回调, 可以在这里做一系列事情
                this.success()
            }
        })
    },
    success () {
        // console.log('创建成功!')
        this.addEventBusListener()
    },
    addEventBusListener() {
      // 监听 element
      let that = this
      console.log(this.bpmnModeler)
      const eventBus = this.bpmnModeler.get('eventBus')
      const eventTypes = ['element.click', 'element.changed', 'element.updateLabel']
      eventTypes.forEach(function(eventType) {
        eventBus.on(eventType, function(e) {
          console.log(eventType)
          if (!e || e.element.type == 'bpmn:Process') return
          if (eventType === 'element.changed') {
            // that.elementChanged(e)
          } else if (eventType === 'element.click') {
            console.log('点击了element', e)
            // if (e.element.type === 'bpmn:Task') {
            // }
          } else if (eventType === 'element.updateLabel') {
            console.log('element.updateLabel', e.element)
          }
        })
      })
    }
  },
// 计算属性
  computed: {}
}
</script>

<style scoped>
.containers{
	background-color: #ffffff;
	width: 100%;
	height: calc(100vh - 52px);
}
.canvas{
	width: 100%;
	height: 100%;
}
.panel{
	position: absolute;
	right: 0;
	top: 0;
	width: 300px;
}
</style>