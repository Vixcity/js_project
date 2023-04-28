import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// 自动导入vue中hook reactive ref等
import AutoImport from "unplugin-auto-import/vite";
//自动导入ui-组件 比如说ant-design-vue  element-plus等
import Components from "unplugin-vue-components/vite";
//element
import { ElementPlusResolver,AntDesignVueResolver } from "unplugin-vue-components/resolvers";

// https://blog.csdn.net/weixin_59916662/article/details/127331094

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    AutoImport({
      //安装两行后你会发现在组件中不用再导入ref，reactive等
      imports: ["vue", "vue-router"],
      //存放的位置
      dts: "src/auto-import.d.ts",
      resolvers: [ElementPlusResolver(), AntDesignVueResolver()],
    }),
    Components({
      // 引入组件的,包括自定义组件
      // 存放的位置
      // dts: "src/components.d.ts",
      //element
      resolvers: [
        ElementPlusResolver(),
        AntDesignVueResolver({ importStyle: true, resolveIcons: true }),
      ],
    }),
  ],
  server: {
    proxy: {
      "/api": {
        // 匹配请求路径，
        target: "你要代理的地址", // 代理的目标地址
        // 开发模式，默认的127.0.0.1,开启后代理服务会把origin修改为目标地址
        changeOrigin: true,
        // secure: true, // 是否https接口
        // ws: true, // 是否代理websockets

        // 路径重写，**** 如果你的后端有统一前缀(如:/api)，就不开启；没有就开启
        //简单来说，就是是否改路径 加某些东西
        rewrite: (path) => path.replace(/^\/api/, ""),
      },
    },
  },
});
