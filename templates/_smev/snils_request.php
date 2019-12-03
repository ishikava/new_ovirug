<?php

$content = '<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope
         xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
         xmlns:ns="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.1"
         xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1"
         xmlns:ns3="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/faults/1.1"
         xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
    <s:Body>
        <ns:SendRequestRequest>
            <ns:SenderProvidedRequestData Id="SIGNED_BY_CONSUMER" wsu:Id="SIGNED_BY_CONSUMER">
            	<ns:MessageID>'.$data['MessageID'].'</ns:MessageID>
                <ns2:MessagePrimaryContent>
                    <tns:SnilsByDataRequest xmlns:tns="http://kvs.pfr.com/snils-by-data/1.1.2">
                        <smev:FamilyName xmlns:smev="urn://x-artefacts-smev-gov-ru/supplementary/commons/1.0.1">'.$data['individual']['lastName'].'</smev:FamilyName>
                        <smev:FirstName xmlns:smev="urn://x-artefacts-smev-gov-ru/supplementary/commons/1.0.1">'.$data['individual']['firstName'].'</smev:FirstName>
                        <smev:Patronymic xmlns:smev="urn://x-artefacts-smev-gov-ru/supplementary/commons/1.0.1">'.$data['individual']['secondName'].'</smev:Patronymic>
                        <tns:Gender>'.$data['individual']['gender'].'</tns:Gender>
                        <tns:BirthDate>'.$data['individual']['birthDay'].'</tns:BirthDate>
                    </tns:SnilsByDataRequest>
                </ns2:MessagePrimaryContent>
            </ns:SenderProvidedRequestData>
            <ns:CallerInformationSystemSignature>
                <ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                    <ds:SignedInfo>
                        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        <ds:SignatureMethod Algorithm="urn:ietf:params:xml:ns:cpxmlsec:algorithms:gostr34102012-gostr34112012-256"/>
                        <ds:Reference URI="#SIGNED_BY_CONSUMER">
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
        </ns:SendRequestRequest>
    </s:Body>
</s:Envelope>';