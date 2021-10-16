import grapesjs from "grapesjs"
import PresetWebpage from "grapesjs-preset-webpage"
import axios from "axios"

const editor = grapesjs.init({
  container: "#gjs",
  storageManager: false,
  fromElement: true,
  plugins: [PresetWebpage],
})

editor.on("load", () => {
  const panelManager = editor.Panels
  panelManager.addButton("options", {
    id: "xe_save",
    command: async (editor) => {
      await axios.put(
        window.location.pathname,
        new URLSearchParams({
          html: editor.getHtml(),
          css: editor.getCss(),
        })
      )
      editor.Modal.setTitle("저장").setContent("저장 완료").open()
    },
    label: "저장하기",
  })
})
