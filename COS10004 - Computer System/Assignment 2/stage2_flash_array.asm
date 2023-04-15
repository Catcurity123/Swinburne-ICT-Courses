; function stage2_flash_array
; flashes the contents of array given
; Arguments:
; r0 - BASE address of peripherals
; r1 - size of array
; r2 - array to flash
; Function returns nothing

stage2_flash_array:
        push {r8}
        loop:
          ldr r8, [r2], #4 ;load the current index onto r8
          push {lr, r1-r2}
            mov r1,r8   ;initialized registers for flashing and pausing
            mov r2, $50000
            bl FLASH
            mov r1, $120000
            bl PAUSE
          pop {lr, r1-r2}
          sub r1, #1  ;minus the size, if the size reaches 0 then end the loop
          cmp r1, #0
         bgt loop
         pop {r8}

        b end1