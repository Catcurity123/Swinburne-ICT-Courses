
# ETHERNET



## Description:
Ethernet is a family of networking technologies that are widely used in **local area networks (LANs)** and **metropolitan area networks (MANs)**.


## Ethernet Frame
![Ethernet Frame Illustration](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Ethernet/EthernetFrame.png?raw=true)

1. **Preamble:** 7 bytes of alternating 1's and 0's, which aalows devices to synchronize with their receiver clocks.

2. **SFD:** Start Frame Delimiter with 1 byte that marks the end of the preamble, and the beginning of the rest of the frame.

3. **Destination and Source :** Indicate the devices sending and receiving the frame. These fields consist of the destination and source `MAC Address`. Each of these fields carries 6 bytes.

4. **Type or Length:** 2 bytes field. If a value is 1500 or less, it will indicate the **LENGTH** of the encapsulated packet. However, if the value is larger than 1500, it indicates the *TYPE** of the encapsulated packet. 
> The Type is usually IPv4 or IPv6, `IPv4 = 0x0800` and `IPv6 = 0x86DD`.

5. **FCS:** Frame Check Sequence contains 7 bytes that detects corrupted data by running `CRC algorithm`.



## MAC Address
- 6 bytes physical address assigned to the device when it is made, hence, BIA (Burned-In Address). It is also globally unique.

- The First 3 bytes are the OUI(Organizationally Unique Identifier), which is assigned to the company making the device.

- The last 3 bytes are unique to the device itself.

## ARP - ADdress Resolution Protocol
- ARP is used to discover the Layer 2 address (MAC address) of a known Layer 3 address (IP address)
- Consist of two message:
  1. `ARP Request` is a broadcast message that ask for the designated MAC address.

  2. `ARP Reply` is a unicast message sent from the designated recipent to the ARP's sender.
