<?php

$content = '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope
         xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
         xmlns:ns="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.1"
         xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1"
         xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
    <s:Body>
        <ns:AckRequest>
            <ns2:AckTargetMessage Id="SIGNED_BY_CALLER" wsu:Id="SIGNED_BY_CALLER" accepted="true">'.$data.'</ns2:AckTargetMessage>
            <ns:CallerInformationSystemSignature>
                <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <ds:SignedInfo>
                        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        <ds:SignatureMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                        <ds:Reference URI="#SIGNED_BY_CALLER">
                            <ds:Transforms>
                                <ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                            </ds:Transforms>
                            <ds:DigestMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34112012-256"/>
                            <ds:DigestValue></ds:DigestValue>
                        </ds:Reference>
                    </ds:SignedInfo>
                    <ds:SignatureValue></ds:SignatureValue>
                    <ds:KeyInfo></ds:KeyInfo>
                </ds:Signature>
            </ns:CallerInformationSystemSignature>
        </ns:AckRequest>
    </s:Body>
</s:Envelope>';