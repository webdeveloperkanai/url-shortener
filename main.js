<script>
    /*
    Transition the page in once everything's loaded.
    */
    $(document).ready(function(e) {
      $(".bg").addClass("active")
      setTimeout(function() {
        $(".page").addClass("active")
        setTimeout(function() {
          $("input").focus()
        }, 400)
      }, 800)
    })



    /*
    Handles shortening a URL.
    */
    $(document).on("submit", ".shorten", function(e) {
      e.preventDefault()
      $(".shorten").addClass("active").find("input").attr("disabled", true)
      var val = $("input[name='url']").val()
      if (!val) {
        return
      }
      $.ajax("?url=" + encodeURIComponent(val) + "&nonce=" + encodeURIComponent(nonce), {
        success: function(data) {
          nonce = data.nonce
          var url = safe(data.link.domain + "/" + data.link.shortname)
          Swal.fire({
            title: "Link shortened",
            html: "<h1 class='shortened' copy='http://" + url + "'>" + url + "</h1>",
            type: "success"
          })
          $(".shorten").removeClass("active").find("input").attr("disabled", false)
        },
        error: function(e) {
          if (e.responseJSON.nonce) {
            nonce = e.responseJSON.nonce
          }
          var error = e.responseJSON.error,
            el = $(".shorten input").get(0)
          $(".shorten").removeClass("active").find("input").attr("disabled", false).focus()
          tippy(el, {
            content: error,
            animation: "scale",
            theme: "light error",
            arrow: true,
            placement: "bottom"
          })
          el._tippy.show()
        }
      })
    })



    /*
    Create copy elements.
    */
    setInterval(function() {
      $("[copy]:not(.copy-created)").addClass("copy-created").each(function() {
        tippy(this, {
          content: "Click to copy",
          animation: "scale",
          theme: "light copy",
          arrow: true,
          hideOnClick: false,
          onHidden: function(ins) {
            ins.setContent("Click to copy")
          }
        })
      })
    }, 150)



    /*
    Copies content on copy element click.
    */
    $(document).on("click", "[copy]", function(e) {
      e.preventDefault()
      var el = $(this),
        tippy = el.get(0)._tippy
      copy(el.attr("copy"))
      tippy.setContent("<span class='copied'>Copied</span>")
    })



    /*
    Handles copying to clipboard.
    */
    function copy(text, skip) {
      if (navigator.clipboard && navigator.clipboard.writeText && !skip) {
        return navigator.clipboard.writeText(text).catch(function(e) {
          return copy(text, true)
        })
      }
      var input = document.createElement("textarea")
      input.value = text
      document.body.appendChild(input)
      input.focus()
      input.select()
      document.execCommand("copy")
      document.body.removeChild(input)
    }

    /*
    Escapes text for safe usage.
    */
    function safe(text) {
      if (!text) {
        return ""
      }
      text = String(text).replace(/\&/gi, "&amp;").replace(/\</gi, "&lt;").replace(/\>/gi, "&gt;").replace(/\"/gi, "&quot;").replace(/\'/gi, "&#x27;").replace(/\//gi, "&#x2F;")
      return text
    }
     